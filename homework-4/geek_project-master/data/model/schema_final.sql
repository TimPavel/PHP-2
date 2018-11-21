CREATE TABLE category
(
  id   int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name varchar(255)        NOT NULL
);

CREATE TABLE `order`
(
  id         int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  created_at timestamp                    DEFAULT CURRENT_TIMESTAMP,
  user_id    int(11)             NOT NULL,
  status     int(11)                      DEFAULT '0',
  CONSTRAINT order_user_fk FOREIGN KEY (user_id) REFERENCES users (id)
);
CREATE INDEX order_user_fk
  ON `order` (user_id);

CREATE TABLE order_item
(
  id         int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  product_id int(11)             NOT NULL,
  order_id   int(11)             NOT NULL,
  quantity   int(11),
  CONSTRAINT order_item_product_fk FOREIGN KEY (product_id) REFERENCES product (id),
  CONSTRAINT order_item_order_fk FOREIGN KEY (order_id) REFERENCES `order` (id)
);
CREATE INDEX order_item_product_fk
  ON order_item (product_id);
CREATE INDEX order_item_order_fk
  ON order_item (order_id);

CREATE TABLE product
(
  id          int(11) PRIMARY KEY           NOT NULL AUTO_INCREMENT,
  name        varchar(255)                  NOT NULL,
  description text,
  price       decimal(10, 2) DEFAULT '0.00' NOT NULL,
  quantity    int(11)                                DEFAULT '1',
  category_id int(11)                       NOT NULL,
  CONSTRAINT product_category_fk FOREIGN KEY (category_id) REFERENCES category (id)
);
CREATE INDEX product_category_fk
  ON product (category_id);

CREATE TABLE reviews
(
  id       int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  content  text                NOT NULL,
  datetime timestamp                    DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users
(
  id       int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  login    varchar(255)        NOT NULL,
  password varchar(255)        NOT NULL
);
CREATE UNIQUE INDEX users_login_uindex
  ON users (login);