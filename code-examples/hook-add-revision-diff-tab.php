<?php

/*
 * FieldLayout::EVENT_CREATE_FORM
 */
public function addRevisionDiffTabToEntryForms(CreateFieldLayoutFormEvent $e)
{
    $element = $e->element;
    if (!$element instanceof Entry) {
        return;
    }
    if (!$element->getIsDraft()) {
        return;
    }

    $e->tabs[] = new FieldLayoutTab([
        'name' => Craft::t('app', 'Compare changes'),
        'layout' => $e->sender,
        'elements' => [
            new RevisionDiff(),
        ],
    ]);
}
