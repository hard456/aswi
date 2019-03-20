CREATE TABLE translation ( 
   id SERIAL NOT NULL, 
   idf varchar(250) NOT NULL, -- jednoznaèný identifikátor textu 
   language char(2) NOT NULL, -- dvoupísmenný kód jazyka 
   translation text NOT NULL, -- pøeklad 
   UNIQUE (language, idf), 
   PRIMARY KEY (id) 
);