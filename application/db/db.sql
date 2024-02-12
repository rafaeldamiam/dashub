DROP DATABASE hub;
CREATE DATABASE hub;
USE hub;

SELECT * FROM USER
DROP TABLE USER

CREATE TABLE user(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	name VARCHAR(100) NOT NULL,
	password VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL UNIQUE,
	profile_img VARCHAR(100) NOT NULL,
	--roles: 'user', 'admin' and 'anon' for users that are not logged
	role VARCHAR(100) NOT NULL
);

INSERT INTO user(name,email,password,profile_img,role)
VALUES
("admin","admin@admin.com","123","public/assets/user.png","admin"),
("user","user@user.com","123","public/assets/user.png", "user");


-----------------------------------------------------------
SELECT * FROM tag
DROP TABLE tag

CREATE TABLE tag(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	nickname VARCHAR(100) NOT NULL,
	name VARCHAR(100) NOT NULL
);

INSERT INTO tag(nickname,name)
VALUES
("CPD", "Centro de Processamento de Dados"),
("SUP", "Suprimentos");

-----------------------------------------------------------
SELECT * FROM site
DROP TABLE site

CREATE TABLE site(
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  title VARCHAR(100) NOT NULL,
  logo VARCHAR(100) NOT NULL,
  url VARCHAR(100) NOT NULL,
  description VARCHAR(100) NOT NULL,
  dt_insert DATE NOT NULL,
  id_owner INTEGER NOT NULL,
  id_tag INTEGER NOT NULL,
  FOREIGN KEY (id_owner) REFERENCES user(id),
  FOREIGN KEY (id_tag) REFERENCES tag(id)
);



INSERT INTO site(title, logo, url, description, dt_insert, id_owner, id_tag) 
VALUES
("Totvs Zendesk", "public/assets/site.png", "https://totvs.fluigidentity.com/" ,"Site de criação de chamados, analise de produto e suporte técnico", DateTime('now'), 1, 1),
("GLPI", "public/assets/site.png", "http://glpi.vistalegre.local/glpi/" ,"Site de criação de chamados internos, controle de dispositivos de TI", DateTime('now'), 1, 1);



--------------------------------------------------------------------
SELECT * FROM user WHERE email = 'admin@admin.com' AND password = '123'

SELECT * FROM site WHERE id = 1

UPDATE site
SET url = 'http://glpi.vistalegre.local/glpi/'
where id = 2



SELECT s.title, s.description, u.name, t.nickname, t.name 
FROM site s, user u, tag t
WHERE s.id_owner = u.id 
AND s.id_tag = t.id
