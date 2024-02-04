CREATE TABLE user(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	registration INTEGER NOT NULL,
	name VARCHAR(100) NOT NULL,
	password VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL UNIQUE,
	--roles: 'user', 'admin' and 'anon' for users that are not logged
	role VARCHAR(100) NOT NULL
);

INSERT INTO user(name,registration,email,password,role)
VALUES
("admin","11111","admin@admin.com","123","admin"),
("user","11111","user@user.com","123","user");

CREATE TABLE tag(
	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	nickname VARCHAR(100) NOT NULL,
	name VARCHAR(100) NOT NULL
);

INSERT INTO tag(nickname,name)
VALUES
("CPD", "Centro de Processamento de Dados"),
("SUP", "Suprimentos");

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
("Totvs Zendesk", "assets/images/totvs.png", "https://totvs.fluigidentity.com/" ,"Site de criação de chamados, analise de produto e suporte técnico", DateTime('now'), 1, 1),
("GLPI", "assets/images/totvs.png", "http://glpi.vistalegre.local/glpi/" ,"Site de criação de chamados internos, controle de dispositivos de TI", DateTime('now'), 1, 1);
