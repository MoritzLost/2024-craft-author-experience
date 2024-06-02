<?php

class RevisionDiff extends BaseUiElement
{
    public function formHtml(
        ?ElementInterface $element = null,
        bool $static = false,
    ): ?string {
        /** @var View $view */
        $view = Craft::$app->view;

        /** @var RevisionDiffModule $module */
        $module = RevisionDiffModule::getInstance();

        if (!$element) {
            return null;
        }
        if (!$element->getIsDraft() || !$element->getIsDerivative()) {
            $noChangesText = Craft::t('app', 'No changes to display');
            return "<p>{$noChangesText}</p>";
        }

        $changes = $module->comparison->getRevisionChanges($element);

        $view->registerCss($module->diff->getDiffCss(), [], 'revision-diff-styles');
        return $view->renderTemplate('_revision-diff/changes-tab', [
            'changes' => $changes,
        ]);
    }
}
