<?php


namespace app\controllers;


use app\models\Migration;

class MigrationController
{

    public static function actionMigration()
    {
        $migration = new Migration();
        if (!$migration::isDatabaseExist()) {
            $migration::createDB();
        }

        if (!$migration::isTablesExist()) {
            $migration::createTables();
        }
    }
}