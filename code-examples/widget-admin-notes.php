<?php

namespace modules\Workflow\widgets;

use Craft;
use craft\base\Widget;
use craft\elements\Entry;

class AdminNotes extends Widget
{
    public static function displayName(): string
    {
        return Craft::t('custom_workflows', 'widget_admin_notes_name');
    }

    public function getBodyHtml(): ?string
    {
        $workflowsSettings = Entry::find()->section('workflows')->one();
        $adminNotes = $workflowsSettings->body ?? null;
      	if (!$adminNotes) {
          return Craft::t('custom_workflows', 'widget_admin_notes_no_content');
        }
        return $adminNotes;
    }
}
