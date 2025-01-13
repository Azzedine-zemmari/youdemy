use youdemy;
create table favoris(
	etudiant_id INT NOT NULL,
    cours_id INT NOT NULL,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (etudiant_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (cours_id) REFERENCES cours(idCours) ON DELETE CASCADE
);
CREATE TABLE cours_tags (
    cours_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (cours_id, tag_id),
    FOREIGN KEY (cours_id) REFERENCES cours(idCours) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(idTag) ON DELETE CASCADE
);
CREATE TABLE tags (
    idTag INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL UNIQUE
);
CREATE TABLE cours (
    idCours INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    contenu TEXT,
    vedeo TEXT,
    categorie_id INT,
    enseignant_id INT NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (enseignant_id) REFERENCES user(id) ON DELETE CASCADE,
    FOREIGN KEY (categorie_id) REFERENCES categories(idCategory) ON DELETE CASCADE
);

CREATE TABLE categories (
    idCategory INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL UNIQUE
);
create table user(
id int primary key auto_increment,
name varchar(40),
email varchar(60),
password text,
status ENUM('active', 'suspended') DEFAULT 'active',
role varchar(10)
);
