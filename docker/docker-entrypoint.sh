#!/bin/sh
set -e

# Run confd
/usr/local/bin/confd -onetime -backend env

# Execute CMD
exec "$@"