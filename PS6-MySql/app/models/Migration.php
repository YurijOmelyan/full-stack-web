<?php


namespace app\models;


use app\models\Database as DB;

class Migration
{

    private static $db;
    private static $prefix = 'create_';
    private static $databaseMigrationFile = 'db.sql';
    private static $db_name;
    private static $tables;


    /**
     * Migration constructor.
     */
    public function __construct()
    {
        $setting = include(ROOT . DB_SETTING);
        self::$db_name = $setting['db']['db_name'];
        self::$tables = $setting['tables'];
        self::$db = new DB($setting);

    }

    public static function isDatabaseExist()
    {
        return !is_array(self::$db->setConnection());
    }

    public static function createDB()
    {
        $create_db = self::$prefix . self::$databaseMigrationFile;
        if (file_exists($file = ROOT . PATH_MIGRATIONS . $create_db)) {
            $sql = file_get_contents($file);
            $sql = str_replace('?db_name?', self::$db_name, $sql);
            $connect = self::$db->connect();
            $connect->query($sql);
            self::$db->setConnection();
        }
    }

    public static function createTables()
    {
        foreach (self::$tables as $index => $tableName) {
            if (!self::isTableExist($tableName)) {
                $table_creation_file = self::$prefix . str_replace('_name', '', $index) . '.sql';
                if (file_exists($file = ROOT . PATH_MIGRATIONS . $table_creation_file)) {
                    $sql = file_get_contents($file);
                    $sql = str_replace('?table_name?', $tableName, $sql);
                    self::$db->prepare($sql);
                    self::$db->execute();
                    self::$db->fetchAll();
                }
            }
        }
    }

    public static function isTablesExist()
    {
        foreach (self::$tables as $tableName) {
            if (!self::isTableExist($tableName)) {
                return false;
            }
        }
        return true;
    }

    private static function isTableExist($tableName): bool
    {
        $sql = "SHOW TABLES LIKE ?";
        self::$db->prepare($sql);
        self::$db->execute([$tableName]);
        return (bool)self::$db->fetchAll();
    }

}