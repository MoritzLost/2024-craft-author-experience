<?php

use Craft;
use verbb\workflow\elements\Submission;
use verbb\workflow\widgets\Submissions;

class OwnSubmissions extends Submissions
{
    public static function displayName(): string
    {
        return Craft::t('custom_workflows', 'widget_own_submissions_name');
    }

    public function getBodyHtml(): ?string
    {
        $user = Craft::$app->user?->getIdentity();
        if (!$user) {
            return '';
        }
        $submissions = Submission::find()
            ->status($this->status)
            ->limit($this->limit)
            ->editorId($user->id)
            ->all();

        return Craft::$app->getView()->renderTemplate('workflow/_widget/body', [
            'submissions' => $submissions,
        ]);
    }
}
