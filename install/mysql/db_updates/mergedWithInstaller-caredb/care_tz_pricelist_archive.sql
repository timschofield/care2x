-- host: localhost
-- Erstellungszeit: 28. November 2008 um 16:06
-- Server Version: 5.0.51
-- PHP-Version: 5.2.4-2ubuntu5.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

SET AUTOCOMMIT=0;
START TRANSACTION;

--
-- Datenbank: `c2x-test`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `care_tz_drugsandservices_archive`
--

CREATE TABLE IF NOT EXISTS `care_tz_drugsandservices_archive` (
  `item_id` bigint(20) NOT NULL,
  `item_number` varchar(50) NOT NULL default '',
  `partcode` varchar(255) default NULL,
  `is_pediatric` smallint(6) NOT NULL default '0',
  `is_adult` smallint(6) NOT NULL default '0',
  `is_other` smallint(6) NOT NULL default '0',
  `is_consumable` smallint(6) NOT NULL default '0',
  `is_labtest` tinyint(4) NOT NULL default '0',
  `item_description` varchar(255) NOT NULL default '',
  `item_full_description` varchar(255) NOT NULL default '',
  `unit_price` varchar(50) NOT NULL default '',
  `unit_price_1` varchar(50) default NULL,
  `unit_price_2` varchar(50) default NULL,
  `unit_price_3` varchar(50) default NULL,
  `purchasing_class` varchar(50) NOT NULL default '',
  `timestamp` bigint(20) default NULL,
  KEY `timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `care_tz_drugsandservices_archive`
--


COMMIT;

