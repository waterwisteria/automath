#!/bin/bash

clear && sail artisan migrate:rollback && sail artisan migrate && clear; sail artisan db:seed
