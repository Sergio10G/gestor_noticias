CREATE DATABASE WEB;
USE WEB;

CREATE TABLE IF NOT EXISTS GALERIA(
	COD				INTEGER AUTO_INCREMENT,
    TITULO			VARCHAR(200) NOT NULL,
    FECHA			TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    TIPO			SET(
						"NACIONAL",
						"INTERNACIONAL",
						"CURIOSIDAD"
					),
	DESTINATARIO	ENUM(
						"INFANTIL",
                        "JUVENIL",
                        "ADULTO"
                    ),
	NOTICIA			MEDIUMTEXT,
    FUENTE			VARCHAR(150) NOT NULL,
    IMAGEN			VARCHAR(100),
    
    PRIMARY KEY(COD)
);

#DROP TABLE GALERIA;

INSERT INTO GALERIA(TITULO, TIPO, DESTINATARIO, NOTICIA, FUENTE, IMAGEN) VALUES 
("EL CAMBIO CLIMÁTICO EN EL MUNDO MODERNO", "INTERNACIONAL", "ADULTO", 
"El cambio climático es el mal de nuestro tiempo y sus consecuencias pueden ser devastadoras si no reducimos drásticamente la dependencia de los combustibles fósiles y las emisiones de gases de efecto invernadero. De hecho, los impactos del cambio climático ya son perceptibles y quedan puestos en evidencia por datos como:
La temperatura media mundial ha aumentado ya 1,1°C desde la época preindustrial
El período 2015-2019, según la Organización Meteorológica Mundial (OMM), será probablemente el quinquenio más cálido jamás registrado
La tasa de subida del nivel del mar ha ascendido a 5 mm al año en el quinquenio 2014 -2019
Pero hoy también estamos viendo los impactos económicos y sociales, que serán cada vez más graves, como:

Daños en las cosechas y en la producción alimentaria
Las sequías
Los riesgos en la salud
Los fenómenos meteorológicos extremos, como danas, tormentas y huracanes
Mega-incendios", "GREENPEACE", "cambioclima.png"),
("RESTOS DEL PALEOLÍTICO EN PARLA", "NACIONAL", "JUVENIL", "Fue descubierto a finales del XIX por unos caminantes franceses que incluyeron en su libro de viajes un grabado de los restos de la antigua Iglesia gótico-mudéjar de Humanejos de los Santos Justo y Pastor que estaba ubicada en mitad de un cerro, actualmente solo queda una pintura de dicha iglesia dibujada por Jenaro Pérez de Villaamil a mediados del siglo XIX en la cual se puede ver el paisaje a su alrededor. En el siglo XX, más concretamente en la década de los ochenta, la extinta diputación llevó a cabo investigaciones. En 1982 se realizaron unas excavaciones donde se encontraron diversos restos arqueólogos en el denominado yacimiento del cerro de la iglesia de Humanejos, ya que este fue el origen de la investigación, aunque no sería hasta la construcción de la autovía A-42 y el desarrollo del polígono industrial Pau 5 en 2008 cuando el yacimiento realmente emergió. Diez años de trabajos arqueológicos y excavaciones han dado su fruto pues se ha descubierto uno de los mayores hallazgos en décadas y aún falta mucho por excavar. Comenzó con una extensión de 2,5 hectáreas y en 2018 ya supera las 20 hectáreas.", 
"UCM ARQUEO", "restospaleo.png");

#TRUNCATE TABLE GALERIA;

SELECT * FROM GALERIA;

CREATE TABLE IF NOT EXISTS NOTICIAS(
	COD				INTEGER AUTO_INCREMENT,
    FECHA			TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    TEXTO 			VARCHAR(200) NOT NULL,
    ENLACE			VARCHAR(250),
    
    PRIMARY KEY(COD)
);

#DROP TABLE NOTICIAS;

INSERT INTO NOTICIAS(TEXTO, ENLACE) VALUES
("GANÍMEDES EMITE UNA SEÑAL, DETECTADA POR LA NASA", 
"<a href='https://www.elperiodico.com/es/ciencia/20210112/nasa-radio-extraterrestres-carlosjesus-ganimedes-11450551' target='_BLANK'>Ganímedes nos llama</a>"),
("EXPLOSIÓN DE GAS EN EL CENTRO DE MADRID", 
"<a href='https://elpais.com/espana/madrid/2021-01-20/explosion-en-un-edificio-del-centro-de-madrid.html' target='_BLANK'>Explosión en Madrid</a>");

#TRUNCATE TABLE NOTICIAS;

SELECT * FROM NOTICIAS;