<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Wgsimpleacc module for xoops
 *
 * @param mixed      $module
 * @param null|mixed $prev_version
 * @package        Wgsimpleacc
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 update.php 1 Mon 2018-03-19 10:04:53Z XOOPS Project (www.xoops.org) $
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 */

/**
 * @param      $module
 * @param null $prev_version
 *
 * @return bool|null
 */
function xoops_module_update_wgsimpleacc($module, $prev_version = null)
{
    $ret = null;
    if ($prev_version < 10) {
        $ret = update_wgsimpleacc_v10($module);
    }

    $ret = wgsimpleacc_check_db($module);

    //check upload directory
	require_once __DIR__ . '/install.php';
    $ret = xoops_module_install_wgsimpleacc($module);

    $errors = $module->getErrors();
    if (!empty($errors)) {
        print_r($errors);
    }

    return $ret;

}

// irmtfan bug fix: solve templates duplicate issue
/**
 * @param $module
 *
 * @return bool
 */
function update_wgsimpleacc_v10($module)
{
    global $xoopsDB;
    $result = $xoopsDB->query(
        'SELECT t1.ttpl_id FROM ' . $xoopsDB->prefix('tplfile') . ' t1, ' . $xoopsDB->prefix('tplfile') . ' t2 WHERE t1.tpl_refid = t2.tpl_refid AND t1.tpl_module = t2.tpl_module AND t1.tpl_tplset=t2.tpl_tplset AND t1.tpl_file = t2.tpl_file AND t1.tpl_type = t2.tpl_type AND t1.ttpl_id > t2.ttpl_id'
    );
    $tplids = [];
    while (false !== (list($tplid) = $xoopsDB->fetchRow($result))) {
        $tplids[] = $tplid;
    }
    if (\count($tplids) > 0) {
        $tplfileHandler  = \xoops_getHandler('tplfile');
        $duplicate_files = $tplfileHandler->getObjects(new \Criteria('ttpl_id', '(' . \implode(',', $tplids) . ')', 'IN'));

        if (\count($duplicate_files) > 0) {
            foreach (\array_keys($duplicate_files) as $i) {
                $tplfileHandler->delete($duplicate_files[$i]);
            }
        }
    }
    $sql = 'SHOW INDEX FROM ' . $xoopsDB->prefix('tplfile') . " WHERE KEY_NAME = 'tpl_refid_module_set_file_type'";
    if (!$result = $xoopsDB->queryF($sql)) {
        xoops_error($xoopsDB->error() . '<br>' . $sql);

        return false;
    }
    $ret = [];
    while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
        $ret[] = $myrow;
    }
    if (!empty($ret)) {
        $module->setErrors("'tpl_refid_module_set_file_type' unique index is exist. Note: check 'tplfile' table to be sure this index is UNIQUE because XOOPS CORE need it.");

        return true;
    }
    $sql = 'ALTER TABLE ' . $xoopsDB->prefix('tplfile') . ' ADD UNIQUE tpl_refid_module_set_file_type ( tpl_refid, tpl_module, tpl_tplset, tpl_file, tpl_type )';
    if (!$result = $xoopsDB->queryF($sql)) {
        xoops_error($xoopsDB->error() . '<br>' . $sql);
        $module->setErrors("'tpl_refid_module_set_file_type' unique index is not added to 'tplfile' table. Warning: do not use XOOPS until you add this unique index.");

        return false;
    }

    return true;
}

// irmtfan bug fix: solve templates duplicate issue

/**
 * @param $module
 *
 * @return bool
 */
function wgsimpleacc_check_db($module)
{
    $ret = true;
	//insert here code for database check

    // Example: update table (add new field)
    $table   = $GLOBALS['xoopsDB']->prefix('wgsimpleacc_transactions');
    $field   = 'tra_curid';
    $check   = $GLOBALS['xoopsDB']->queryF('SHOW COLUMNS FROM `' . $table . "` LIKE '" . $field . "'");
    $numRows = $GLOBALS['xoopsDB']->getRowsNum($check);
    if (!$numRows) {
        $sql = "ALTER TABLE `$table` CHANGE `tra_currid` `tra_curid` INT(10) NOT NULL DEFAULT '0';";
        if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
            xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
            $module->setErrors("Error when adding '$field' to table '$table'.");
            $ret = false;
        }
    } 

    // Example: update table (add new field)
    $table   = $GLOBALS['xoopsDB']->prefix('wgsimpleacc_balances');
    $field   = 'bal_curid';
    $check   = $GLOBALS['xoopsDB']->queryF('SHOW COLUMNS FROM `' . $table . "` LIKE '" . $field . "'");
    $numRows = $GLOBALS['xoopsDB']->getRowsNum($check);
    if (!$numRows) {
        $sql = "ALTER TABLE `$table` CHANGE `bal_currid` `bal_curid` INT(10) NOT NULL DEFAULT '0';";
        if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
            xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
            $module->setErrors("Error when adding '$field' to table '$table'.");
            $ret = false;
        }
    }

    // Example: update table (add new field)
    $table   = $GLOBALS['xoopsDB']->prefix('wgsimpleacc_currencies');
    $field   = 'cur_primary';
    $check   = $GLOBALS['xoopsDB']->queryF('SHOW COLUMNS FROM `' . $table . "` LIKE '" . $field . "'");
    $numRows = $GLOBALS['xoopsDB']->getRowsNum($check);
    if (!$numRows) {
        $sql = "ALTER TABLE `$table` ADD `$field` INT(1) NOT NULL AFTER `cur_name`;";
        if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
            xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
            $module->setErrors("Error when adding '$field' to table '$table'.");
            $ret = false;
        }
    }
    // Example: update table (add new field)
    $table   = $GLOBALS['xoopsDB']->prefix('wgsimpleacc_transactions');
    $field   = 'tra_balid';
    $check   = $GLOBALS['xoopsDB']->queryF('SHOW COLUMNS FROM `' . $table . "` LIKE '" . $field . "'");
    $numRows = $GLOBALS['xoopsDB']->getRowsNum($check);
    if (!$numRows) {
        $sql = "ALTER TABLE `$table` ADD `$field` INT(10) NOT NULL AFTER `tra_class`;";
        if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
            xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
            $module->setErrors("Error when adding '$field' to table '$table'.");
            $ret = false;
        }
    }
    // Example: update table (add new field)
    $table   = $GLOBALS['xoopsDB']->prefix('wgsimpleacc_transactions');
    $field   = 'tra_nb';
    $check   = $GLOBALS['xoopsDB']->queryF('SHOW COLUMNS FROM `' . $table . "` LIKE '" . $field . "'");
    $numRows = $GLOBALS['xoopsDB']->getRowsNum($check);
    if (!$numRows) {
        $sql = "ALTER TABLE `$table` ADD `$field` INT(10) NOT NULL Default'0' AFTER `tra_id`;";
        if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
            xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
            $module->setErrors("Error when adding '$field' to table '$table'.");
            $ret = false;
        }
    }
    // Example: update table (add new field)
    $table   = $GLOBALS['xoopsDB']->prefix('wgsimpleacc_transactions');
    $field   = 'tra_year';
    $check   = $GLOBALS['xoopsDB']->queryF('SHOW COLUMNS FROM `' . $table . "` LIKE '" . $field . "'");
    $numRows = $GLOBALS['xoopsDB']->getRowsNum($check);
    if (!$numRows) {
        $sql = "ALTER TABLE `$table` ADD `$field` INT(10) NOT NULL Default'0' AFTER `tra_id`;";
        if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
            xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
            $module->setErrors("Error when adding '$field' to table '$table'.");
            $ret = false;
        }
    }
    $table   = $GLOBALS['xoopsDB']->prefix('wgsimpleacc_balances');
    $field   = 'bal_curid';
    $check   = $GLOBALS['xoopsDB']->queryF('SHOW COLUMNS FROM `' . $table . "` LIKE '" . $field . "'");
    $numRows = $GLOBALS['xoopsDB']->getRowsNum($check);
    if (!$numRows) {
        $sql = "ALTER TABLE `$table` ADD `$field` INT(10) NOT NULL AFTER `bal_to`;";
        if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
            xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
            $module->setErrors("Error when adding '$field' to table '$table'.");
            $ret = false;
        }
    }
    $table   = $GLOBALS['xoopsDB']->prefix('wgsimpleacc_balances');
    $field   = 'bal_amount';
    $check   = $GLOBALS['xoopsDB']->queryF('SHOW COLUMNS FROM `' . $table . "` LIKE '" . $field . "'");
    $numRows = $GLOBALS['xoopsDB']->getRowsNum($check);
    if (!$numRows) {
        $sql = "ALTER TABLE `$table` ADD `$field` DOUBLE(16, 2) NOT NULL DEFAULT '0.00' AFTER `bal_curid`;";
        if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
            xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
            $module->setErrors("Error when adding '$field' to table '$table'.");
            $ret = false;
        }
    }
    $table   = $GLOBALS['xoopsDB']->prefix('wgsimpleacc_balances');
    $field   = 'bal_asid';
    $check   = $GLOBALS['xoopsDB']->queryF('SHOW COLUMNS FROM `' . $table . "` LIKE '" . $field . "'");
    $numRows = $GLOBALS['xoopsDB']->getRowsNum($check);
    if (!$numRows) {
        $sql = "ALTER TABLE `$table` ADD `$field` INT(10) NOT NULL AFTER `bal_to`;";
        if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
            xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
            $module->setErrors("Error when adding '$field' to table '$table'.");
            $ret = false;
        }
    }
    $table   = $GLOBALS['xoopsDB']->prefix('wgsimpleacc_assets');
    $field   = 'as_color';
    $check   = $GLOBALS['xoopsDB']->queryF('SHOW COLUMNS FROM `' . $table . "` LIKE '" . $field . "'");
    $numRows = $GLOBALS['xoopsDB']->getRowsNum($check);
    if (!$numRows) {
        $sql = "ALTER TABLE `$table` ADD `$field` VARCHAR(50) NULL AFTER `bal_to`;";
        if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
            xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
            $module->setErrors("Error when adding '$field' to table '$table'.");
            $ret = false;
        }
    }
    $table   = $GLOBALS['xoopsDB']->prefix('wgsimpleacc_accounts');
    $field   = 'acc_color';
    $check   = $GLOBALS['xoopsDB']->queryF('SHOW COLUMNS FROM `' . $table . "` LIKE '" . $field . "'");
    $numRows = $GLOBALS['xoopsDB']->getRowsNum($check);
    if (!$numRows) {
        $sql = "ALTER TABLE `$table` ADD `$field` VARCHAR(7) NULL AFTER `acc_Classification`;";
        if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
            xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
            $module->setErrors("Error when adding '$field' to table '$table'.");
            $ret = false;
        }
    }
    $table   = $GLOBALS['xoopsDB']->prefix('wgsimpleacc_accounts');
    $field   = 'acc_iecalc';
    $check   = $GLOBALS['xoopsDB']->queryF('SHOW COLUMNS FROM `' . $table . "` LIKE '" . $field . "'");
    $numRows = $GLOBALS['xoopsDB']->getRowsNum($check);
    if (!$numRows) {
        $sql = "ALTER TABLE `$table` ADD `$field` int(1) NOT NULL DEFAULT '0' AFTER `acc_color`;";
        if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
            xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
            $module->setErrors("Error when adding '$field' to table '$table'.");
            $ret = false;
        }
    }





    // Example: create new table
    $table   = $GLOBALS['xoopsDB']->prefix('wgsimpleacc_tratemplates');
    $check   = $GLOBALS['xoopsDB']->queryF("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='$table'");
    $numRows = $GLOBALS['xoopsDB']->getRowsNum($check);
    if (!$numRows) {
        // create new table 'wgsimpleacc_categories'
        $sql = "CREATE TABLE `$table` (
            `ttpl_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
              `ttpl_name` VARCHAR(255) NOT NULL DEFAULT '',
              `ttpl_desc` VARCHAR(255) NOT NULL DEFAULT '',
              `ttpl_accid` INT(10) NOT NULL DEFAULT '0',
              `ttpl_allid` INT(10) NOT NULL DEFAULT '0',
              `ttpl_asid` INT(10) NOT NULL DEFAULT '0',
              `ttpl_amountin` DOUBLE(16, 2) NOT NULL DEFAULT '0.00',
              `ttpl_amountout` DOUBLE(16, 2) NOT NULL DEFAULT '0.00',
              `ttpl_online` INT(1) NOT NULL DEFAULT '0',
              `ttpl_datecreated` INT(10) NOT NULL DEFAULT '0',
              `ttpl_submitter` INT(10) NOT NULL DEFAULT '0',
              PRIMARY KEY (`ttpl_id`)
            ) ENGINE=InnoDB;";
        if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
            xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
            $module->setErrors("Error when creating table '$table'.");
            $ret = false;
        }
    }

    // Example: create new table
    $table   = $GLOBALS['xoopsDB']->prefix('wgsimpleacc_outtemplates');
    $check   = $GLOBALS['xoopsDB']->queryF("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='$table'");
    $numRows = $GLOBALS['xoopsDB']->getRowsNum($check);
    if (!$numRows) {
        // create new table 'wgsimpleacc_categories'
        $sql = "CREATE TABLE `$table` (
            `otpl_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
            `otpl_name` VARCHAR(255) NOT NULL DEFAULT '',
            `otpl_content` TEXT NOT NULL ,
            `otpl_online` INT(1) NOT NULL DEFAULT '0',
            `otpl_datecreated` INT(10) NOT NULL DEFAULT '0',
            `otpl_submitter` INT(10) NOT NULL DEFAULT '0',
            PRIMARY KEY (`otpl_id`)
            ) ENGINE=InnoDB;";
        if (!$result = $GLOBALS['xoopsDB']->queryF($sql)) {
            xoops_error($GLOBALS['xoopsDB']->error() . '<br>' . $sql);
            $module->setErrors("Error when creating table '$table'.");
            $ret = false;
        }
    }

}