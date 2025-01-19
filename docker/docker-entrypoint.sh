#!/bin/sh
set -e

# Run confd
confd -onetime -backend env

# Execute CMD
exec "$@"