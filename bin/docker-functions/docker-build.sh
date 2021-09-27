#!/usr/bin/env bash

function docker-build-help() {
    printf "(Build the Docker images for this project)";
}

function docker-build() {
    set -e;

    # Save the directory we started in
    ORIGINAL_DIR=${PWD};

    SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" >/dev/null 2>&1 && pwd)";
    WORK_DIR="$(dirname $(dirname "${SCRIPT_DIR}"))";

    # CD into the work dir
    cd ${WORK_DIR};

    # Run the db build
    printf "${Cyan}Building craft-slim-bridge-dev-db${Reset}\n";
    DOCKER_BUILDKIT=1 docker build ${WORK_DIR} \
        --tag craft-slim-bridge-dev-db \
        --file docker/db/Dockerfile;
    printf "${Green}Finished building craft-slim-bridge-dev-db${Reset}\n\n";

    # Run the app build
    printf "${Cyan}Building craft-slim-bridge-dev-app${Reset}\n";
    DOCKER_BUILDKIT=1 docker build ${WORK_DIR} \
        --tag craft-slim-bridge-dev-app \
        --file docker/application/Dockerfile;
    printf "${Green}Finished building craft-slim-bridge-dev-app${Reset}\n\n";

    # CD Back to original directory
    cd ${ORIGINAL_DIR};

    return 0;
}
