Deploy instruction.

1. Copy .env.sample to .env
2. Check parametrs in .env

Check next params for conflict with other projects:

COMPOSE_PROJECT_NAME=projectname
DOMAIN=projectname.loc
PREFIX_SUBNET=172.79.0.  

ENV=loc  - environment mode

3. Add host to /etc/hosts (need root)

172.79.0.21 projectname.loc

4. docker-compose up --build

