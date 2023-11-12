db = db.getSiblingDB('admin');
db.auth(
  'root',
  '12345678',
);

db = db.getSiblingDB('twitter_app');
db = db.getSiblingDB('test');
db.createCollection('test_docker');
