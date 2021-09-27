#!/usr/bin/env bash

function docker-up-help() {
    printf "(Brings Docker environment online)";
}

function docker-up() {
    # Save the directory we started in
    ORIGINAL_DIR=${PWD};

    SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" >/dev/null 2>&1 && pwd)";
    WORK_DIR="$(dirname $(dirname "${SCRIPT_DIR}"))";

    # CD into the work dir
    cd ${WORK_DIR};

    # Bring things up
    COMPOSE_DOCKER_CLI_BUILD=1 DOCKER_BUILDKIT=1 docker-compose ${composeFiles} -p craft-slim-bridge up -d;

    # CD Back to original directory
    cd ${ORIGINAL_DIR};

    return 0;
}
