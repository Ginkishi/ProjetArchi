#  IDPersonne ------> table pompier
#  IDTypeIntervention ------------> table type_intervention
#  IDvehicule -----------> table type_vehicule
#  IDRole -------------------> table type_vehicule_role

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

#-----------------------------
# table interventions
#-----------------------------

DROP TABLE IF EXISTS interventions;
CREATE TABLE `interventions` ( `IDIntervention` INT NOT NULL AUTO_INCREMENT , `NIntervention` INT NOT NULL , 
`OPM` BOOLEAN NOT NULL , `Commune` VARCHAR(50) NOT NULL , `Adresse` VARCHAR(100) NOT NULL ,
 `IDTypeIntervention` INT NOT NULL , `Important` BOOLEAN NOT NULL , `Requerant` VARCHAR(15) NOT NULL ,
 `DateDeclenchement` TIMESTAMP NOT NULL , `DateFin` TIMESTAMP NOT NULL, `IDResponsable` INT NOT NULL , `IDCreateur` INT NOT NULL, PRIMARY KEY (`IDIntervention`))
  ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_general_ci;

#-----------------------------
# table vehiculeUtilise
#-----------------------------

DROP TABLE IF EXISTS vehiculeUtilise;
CREATE TABLE `vehiculeUtilise` ( `IDVehicule` INT NOT NULL , `IDIntervention` INT NOT NULL, 
`DateDepart` TIMESTAMP NOT NULL , `DateArrive` TIMESTAMP NOT NULL , `DateRetour` TIMESTAMP NOT NULL ,
PRIMARY KEY (`IDVehicule`, `IDIntervention`)) ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_general_ci;

#-----------------------------
# table personnelDuVehicule
#-----------------------------

DROP TABLE IF EXISTS personnelDuVehicule;
CREATE TABLE `personnelDuVehicule` ( `IDVehicule` INT NOT NULL , `IDPersonne` INT NOT NULL , 
`IDIntervention` INT NOT NULL , `IDrole` INT NOT NULL , PRIMARY KEY (`IDVehicule`, `IDPersonne`, `IDIntervention`)) 
ENGINE = MyISAM CHARSET=utf8 COLLATE utf8_general_ci;
