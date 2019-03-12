DELETE FROM `wpl_options` WHERE `option_name` LIKE '_site_transient%';
DELETE FROM `wpl_options` WHERE `option_name` LIKE '_transient%';
DELETE FROM `wpl_itsec_logs`;
DELETE FROM `wpl_itsec_temp`;
