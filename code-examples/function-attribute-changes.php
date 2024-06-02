<?php

public function getAttributeChanges(Element $element): array
{
    $new = $element;
    $old = $element->getCanonical();

    $modifiedAttributes = $new->getModifiedAttributes();
    $changes = [];
    foreach ($modifiedAttributes as $attribute) {
        $oldValue = $old->{$attribute};
        $newValue = $new->{$attribute};
        $changes[$attribute] = [
            'label' => Craft::t('app', $new->getAttributeLabel($attribute)),
            'diff' => $this->diffValues(
                $this->prepareAttributeForComparison($attribute, $oldValue),
                $this->prepareAttributeForComparison($attribute, $newValue),
            ),
        ];
    }
    return $changes;
}
