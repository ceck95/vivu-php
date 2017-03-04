CREATE SCHEMA IF NOT EXISTS adminuser;

CREATE TABLE adminuser.role (
  uid SERIAL NOT NULL,
  name TEXT NOT NULL,
  status INT,
  created_at timestamp with time zone NOT NULL DEFAULT NOW(),
  updated_at timestamp with time zone NOT NULL DEFAULT NOW(),
  created_by BIGINT,
  updated_by BIGINT,
  CONSTRAINT adminuser_role_pkey PRIMARY KEY (uid)
);

CREATE TABLE adminuser.user (
  uid SERIAL NOT NULL,
  role_id INT,
  email TEXT,
  username TEXT,
  fullname TEXT,
  dob timestamp,
  avatar TEXT,
  position TEXT,
  "desc" TEXT,
  auth_key TEXT,
  password_hash TEXT,
  password_reset_token TEXT,
  status INT,
  created_at timestamp with time zone NOT NULL DEFAULT NOW(),
  updated_at timestamp with time zone NOT NULL DEFAULT NOW(),
  created_by BIGINT,
  updated_by BIGINT,
  CONSTRAINT adminuser_user_pkey PRIMARY KEY (uid)
);

CREATE TABLE adminuser.role_right (
  uid SERIAL NOT NULL,
  role_id INT,
  module TEXT,
  controller TEXT,
  action text,
  is_owner SMALLINT,
  status INT,
  created_at timestamp with time zone NOT NULL DEFAULT NOW(),
  updated_at timestamp with time zone NOT NULL DEFAULT NOW(),
  created_by BIGINT,
  updated_by BIGINT,
  CONSTRAINT adminuser_role_right PRIMARY KEY (uid)

);

INSERT INTO adminuser.role (name, status) VALUES ('admin', 1);
INSERT INTO adminuser.user (username, password_hash ,status) VALUES ('sadmin', '$2y$13$V7wZt1TTMiDfEex8Xw/vLet2CBt1swqVKPipPR4g00rvBNoQ0lwXS', 1);
