<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Device
 *
 * @property int $id
 * @property int|null $ship_id
 * @property string $container_serial
 * @property string $imei
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Ship|null $ship
 * @method static \Database\Factories\DeviceFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Device filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device newQuery()
 * @method static \Illuminate\Database\Query\Builder|Device onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Device query()
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereContainerSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereImei($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereShipId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Device withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Device withoutTrashed()
 */
	class Device extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Ship
 *
 * @property int $id
 * @property string $name
 * @property string|null $imo
 * @property string $ssid
 * @property string $ssid_password
 * @property int|null $wifi_ping
 * @property int|null $gsm_ping
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Device[] $devices
 * @property-read int|null $devices_count
 * @method static \Database\Factories\ShipFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Ship filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Ship newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ship newQuery()
 * @method static \Illuminate\Database\Query\Builder|Ship onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Ship query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ship whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ship whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ship whereGsmPing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ship whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ship whereImo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ship whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ship whereSsid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ship whereSsidPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ship whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ship whereWifiPing($value)
 * @method static \Illuminate\Database\Query\Builder|Ship withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Ship withoutTrashed()
 */
	class Ship extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

