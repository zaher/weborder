#
# Table structure for table 'customers'
#

CREATE TABLE `customers` (
  `CstID` int(10) unsigned NOT NULL auto_increment,
  `CstName` text,
  `CstTitle` varchar(50) default NULL,
  `CstRegion` int(10) unsigned default NULL,
  `CstAddress` varchar(100) default NULL,
  `CstEmail` varchar(100) default NULL,
  `CstPhone` varchar(30) default NULL,
  `CstUsername` varchar(100) default NULL,
  `CstPassword` varchar(100) default NULL,
  `CstIsAdmin` smallint(3) default '0',
  PRIMARY KEY  (`CstID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;



#
# Table structure for table 'groups'
#

CREATE TABLE `groups` (
  `GrpID` int(11) NOT NULL default '0',
  `GrpName` varchar(100) NOT NULL default '',
  `GrpPhoto` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`GrpID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



#
# Table structure for table 'materials'
#

CREATE TABLE `materials` (
  `MatID` bigint(20) NOT NULL auto_increment,
  `MatCode` varchar(60) default '0',
  `MatName` varchar(100) NOT NULL default '',
  `MatGroup` int(10) unsigned default NULL,
  `MatPrice` float default NULL,
  `MatUnitName` varchar(50) NOT NULL default '',
  `MatDescription` varchar(200) default NULL,
  PRIMARY KEY  (`MatID`),
  KEY `Un` (`MatCode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



#
# Table structure for table 'orderitems'
#

CREATE TABLE `orderitems` (
  `MatMaster` int(11) NOT NULL default '0',
  `MatMaterial` int(11) NOT NULL default '0',
  `MatQnt` decimal(10,0) NOT NULL default '0',
  `MatPrice` decimal(10,0) default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



#
# Table structure for table 'orders'
#

CREATE TABLE `orders` (
  `OrdID` int(11) NOT NULL auto_increment,
  `OrdCustomer` int(11) default '0',
  `OrdDate` date default '0000-00-00',
  `OrdState` smallint(5) unsigned default NULL,
  `OrdNote` text,
  PRIMARY KEY  (`OrdID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
