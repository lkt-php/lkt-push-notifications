<?php

namespace Lkt\Mailing\Config\Schemas;

use Lkt\Factory\Schemas\Fields\DateTimeField;
use Lkt\Factory\Schemas\Fields\ForeignKeyField;
use Lkt\Factory\Schemas\Fields\IdField;
use Lkt\Factory\Schemas\Fields\IntegerChoiceField;
use Lkt\Factory\Schemas\InstanceSettings;
use Lkt\Factory\Schemas\Schema;
use Lkt\PushNotifications\Enums\DeliveryStatus;
use Lkt\PushNotifications\Enums\DevicePlatform;
use Lkt\PushNotifications\Instances\LktPushDelivery;
use Lkt\PushNotifications\Instances\LktPushDevice;
use Lkt\PushNotifications\Instances\LktPushNotification;

Schema::add(
    Schema::table('lkt_push_deliveries', LktPushDelivery::COMPONENT)
        ->setInstanceSettings(
            InstanceSettings::define(LktPushDelivery::class)
                ->setNamespaceForGeneratedClass('Lkt\Mailing\Generated')
                ->setWhereStoreGeneratedClass(__DIR__ . '/../../Generated')
        )
        ->addField(DateTimeField::define('createdAt', 'created_at')->setCurrentTimeStampAsDefaultValue())
        ->addField(DateTimeField::define('sentAt', 'sent_at'))
        ->addField(IdField::define('id'))
        ->addField(IntegerChoiceField::enumChoice(DeliveryStatus::class, 'status'))
        ->addField(ForeignKeyField::defineRelation(LktPushDevice::COMPONENT, 'device', 'device_id'))
        ->addField(ForeignKeyField::defineRelation(LktPushNotification::COMPONENT, 'notification', 'notification_id'))
);