-- phpMyAdmin SQL Dump
-- version 2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: June 20, 2008 at 02:57 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `computershop`
--

-- --------------------------------------------------------

CREATE DATABASE ComputerShop;
USE ComputerShop;

--
-- Table structure for table `produse`
--

CREATE TABLE IF NOT EXISTS `produse` (
  `ID` int(11) NOT NULL auto_increment,
  `Nume` varchar(100) NOT NULL,
  `Producator` varchar(50) NOT NULL,
  `Categorie` varchar(25) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `produse`
--

INSERT INTO `produse` (`ID`, `Nume`, `Producator`, `Categorie`) VALUES
(1, 'Toshiba Satelite', 'Toshiba', 'Intel Duo Core'),
(2, 'HP Pavilion', '', 'Athlon 64 XP');

-- --------------------------------------------------------

--
-- Table structure for table `produsecom`
--

CREATE TABLE IF NOT EXISTS `produsecom` (
  `IDProdus` int(11) NOT NULL,
  `IDcomanda` int(11) NOT NULL,
  `cantitate` int(11) NOT NULL,
  PRIMARY KEY  (`IDProdus`,`IDcomanda`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produsecom`
--


-- --------------------------------------------------------

--
-- Table structure for table `comenzi`
--

CREATE TABLE IF NOT EXISTS `comenzi` (
  `ID` int(11) NOT NULL,
  `User` int(11) NOT NULL,
  `Data` datetime NOT NULL,
  `Status` enum('comanda noua','in curs de livrare','livrat') NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comenzi`
--


-- --------------------------------------------------------

--
-- Table structure for table `useri`
--

CREATE TABLE IF NOT EXISTS `useri` (
  `ID` int(11) NOT NULL auto_increment,
  `Nume` varchar(50) NOT NULL,
  `Parola` varchar(16) NOT NULL,
  `Adresa` varchar(100) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `useri`
--

INSERT INTO `useri` (`ID`, `Nume`, `Parola`, `Adresa`) VALUES
(1, 'Eu', 'eu1234', 'aaaa');

-- --------------------------------------------------------

--
-- Table structure for table `caracteristici`
--

CREATE TABLE IF NOT EXISTS `caracteristici` (
  `ID` int(11) NOT NULL,
  `IDProdus` int(11) NOT NULL,
  `Procesor` varchar(50) NOT NULL,
  `An` year(4) NOT NULL,
  `Pret` decimal(10,0) NOT NULL,
  `Disp` int(11) NOT NULL,
  PRIMARY KEY  (`ID`,`IDProdus`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `caracteristici`
--

INSERT INTO `caracteristici` (`ID`, `IDProdus`, `Procesor`, `An`, `Pret`, `Disp`) VALUES
(0, 1, 'Acer Aspire', 2007, 17999, 12);
