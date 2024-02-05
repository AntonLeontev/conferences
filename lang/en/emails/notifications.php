<?php

return [
    'thesis_created_participant_notification' => [
        'subject' => 'Abstracts sending success',
        'text' => 'This is to notify that your abstract :abstract_title has been received and given the ID :abstract_id. Please use this ID in the further correspondence. Pdf copy of this abstract is attached.',
        'action' => 'Edit abstract',
        'salutation' => 'Program Committee of :conference_title',
    ],
    'thesis_created_organization_notification' => [
        'subject' => 'Abstracts were received',
        'text' => 'A new abstract entitled :abstract_title by :authors has been received by :conference_title abstract submission system at :datetime and given the ID :abstract_id. Pdf copy of this abstract is attached.',
    ],
];
