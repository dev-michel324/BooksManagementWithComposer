<?php

use Michel\Projeto\Models\Model;

Model::registerConection(new SQLite3(__DIR__.'/banco.db'));
Model::registerModel('CREATE TABLE IF NOT EXISTS users(id INTEGER PRIMARY KEY, usr_name VARCHAR (155) NOT NULL, usr_email VARCHAR (255) UNIQUE NOT NULL, usr_password TEXT NOT NULL)');
Model::registerModel('CREATE TABLE IF NOT EXISTS books(id INTEGER PRIMARY KEY, boo_title VARCHAR (255) NOT NULL, boo_year INTEGER NOT NULL, boo_autor VARCHAR (255) NOT NULL, boo_id_user INTEGER NOT NULL, FOREIGN KEY (boo_id_user) REFERENCES users(id))');
Model::registerModel('CREATE TABLE IF NOT EXISTS lendings(id INTEGER PRIMARY KEY, len_id_book INTEGER NOT NULL, len_id_user INTEGER NOT NULL, FOREIGN KEY (len_id_book) REFERENCES books(id), FOREIGN KEY (len_id_user) REFERENCES users(id))');