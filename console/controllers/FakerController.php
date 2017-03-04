<?php

/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 6/10/16
 * Time: 3:44 PM
 */

namespace console\controllers;

use backend\business\BusinessDriverTransaction;
use common\models\Customer;
use common\models\Driver;
use common\models\DriverTransaction;
use common\models\Trip;
use common\modules\bank\models\Bank;
use common\modules\notification\models\CustomerNotification;
use common\modules\notification\models\DriverNotification;
use common\modules\vehicle\business\BusinessVehicle;
use common\modules\vehicle\models\Vehicle;
use common\modules\vehicle\models\VehicleModel;
use common\modules\vehicle\models\VehicleType;
use common\utilities\ArraySimple;
use yii\console\Controller;
use Faker\Factory;
use yii\helpers\Console;

class FakerController extends Controller
{

}