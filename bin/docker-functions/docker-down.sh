#!/usr/bin/env bash

function docker-down-help {
    printf "(Spins down the Docker environment)";
}

function docker-down() {
    # Save the directory we started in
    ORIGINAL_DIR=${PWD};

    SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" >/dev/null 2>&1 && pwd)";
    WORK_DIR="$(dirname $(dirname "${SCRIPT_DIR}"))";

    # CD into the work dir
    cd ${WORK_DIR};

    # Bring things up
    docker-compose ${composeFiles} -p craft-slim-bridge down;

    # CD Back to original directory
    cd ${ORIGINAL_DIR};

    return 0;
}
