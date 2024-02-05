<?php

return [
    'thesis_created_participant_notification' => [
        'subject' => 'Тезисы получены',
        'text' => 'Это уведомление о том, что ваши тезисы :abstract_title получены и им присвоен ID :abstract_id. Пожалуйста, используйте этот идентификатор в дальнейшей переписке. Копия данного тезиса в формате PDF прилагается.',
        'action' => 'Редактировать тезисы',
        'salutation' => 'Программный комитет. :conference_title',
    ],
    'thesis_created_organization_notification' => [
        'subject' => 'Получены новые тезисы',
        'text' => 'Новые тезисы с заголовком :abstract_title, авторством :authors были получены на мероприятие :conference_title системой подачи тезисов :datetime. Им присвоен идентификатор :abstract_id. Копия данного тезиса в формате PDF прилагается.',
    ],
];
