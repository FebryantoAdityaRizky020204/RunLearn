-- ===========================================================
CREATE ROLE admin_role;
SHOW PRIVILEGES;

GRANT SELECT, INSERT, UPDATE, DELETE ON sahabat_satwa.* TO 'admin_role';
REVOKE INSERT, UPDATE, DELETE ON `sahabat_satwa`.`audit_log` FROM 'admin_role';

GRANT EXECUTE ON PROCEDURE sahabat_satwa.get_animal_visit_history TO 'admin_role';
GRANT EXECUTE ON PROCEDURE sahabat_satwa.get_animals_by_type TO 'admin_role';
GRANT EXECUTE ON PROCEDURE sahabat_satwa.get_visits_by_date_range TO 'admin_role';


CREATE USER 'admin_user' IDENTIFIED BY 'admin_password' DEFAULT ROLE 'admin_role';

-- ===========================================================

CREATE ROLE vet_role;

GRANT SELECT ON sahabat_satwa.owners TO 'vet_role';
GRANT SELECT ON sahabat_satwa.clinic TO 'vet_role';
GRANT SELECT ON sahabat_satwa.animal_type TO 'vet_role';
GRANT SELECT ON sahabat_satwa.specialisation TO 'vet_role';
GRANT SELECT ON sahabat_satwa.drug TO 'vet_role';
GRANT SELECT, UPDATE ON sahabat_satwa.vet TO 'vet_role';
GRANT SELECT, UPDATE ON sahabat_satwa.animal TO 'vet_role';
GRANT SELECT, INSERT, UPDATE ON sahabat_satwa.visit TO 'vet_role';
GRANT SELECT, INSERT ON sahabat_satwa.visit_drug TO 'vet_role';
GRANT SELECT ON sahabat_satwa.spec_visit TO 'vet_role';

CREATE USER 'vet_user' IDENTIFIED BY 'vet_password' DEFAULT ROLE 'vet_role';

-- ===========================================================

CREATE ROLE pet_owner_role;

GRANT SELECT, UPDATE, INSERT, DELETE ON sahabat_satwa.owners TO pet_owner_role;
GRANT SELECT, UPDATE, INSERT, DELETE ON sahabat_satwa.animal TO pet_owner_role;
GRANT SELECT ON sahabat_satwa.animal_type TO pet_owner_role;
GRANT SELECT ON sahabat_satwa.visit TO pet_owner_role;
GRANT SELECT ON sahabat_satwa.vet TO pet_owner_role;
GRANT SELECT ON sahabat_satwa.drug TO pet_owner_role;
GRANT SELECT ON sahabat_satwa.visit_drug TO pet_owner_role;

CREATE USER 'pet_owner_user' IDENTIFIED BY 'pet_owner_password' DEFAULT ROLE 'pet_owner_role';