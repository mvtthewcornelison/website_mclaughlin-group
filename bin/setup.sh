#!/usr/bin/env bash
set -euo pipefail

REPO_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"

usage() {
  echo "Usage: $0 <wordpress-studio-site-folder>"
  echo ""
  echo "  <wordpress-studio-site-folder>  Path to the site folder WordPress Studio created."
  echo "  Find it via Studio → your site → the folder icon (Show in Finder)."
  echo ""
  echo "  Example: $0 ~/Library/Application\\ Support/com.wordpress.studio/sites/tmg"
  exit 1
}

[[ $# -lt 1 ]] && usage

SITE_DIR="${1%/}"   # strip trailing slash

if [[ ! -d "$SITE_DIR" ]]; then
  echo "Error: '$SITE_DIR' is not a directory. Check the path from WordPress Studio."
  exit 1
fi

WP_CONTENT="$SITE_DIR/wp-content"

# Bail if wp-content is already a symlink pointing at this repo.
if [[ -L "$WP_CONTENT" ]]; then
  CURRENT_TARGET="$(readlink "$WP_CONTENT")"
  if [[ "$CURRENT_TARGET" == "$REPO_DIR" ]]; then
    echo "Already set up — $WP_CONTENT already points to this repo."
    exit 0
  fi
fi

# Back up the default wp-content Studio created.
if [[ -d "$WP_CONTENT" && ! -L "$WP_CONTENT" ]]; then
  BACKUP="$SITE_DIR/wp-content.studio-backup"
  echo "Backing up default wp-content → $BACKUP"
  mv "$WP_CONTENT" "$BACKUP"
fi

# Symlink this repo as wp-content.
ln -s "$REPO_DIR" "$WP_CONTENT"
echo "Done — $WP_CONTENT → $REPO_DIR"
echo ""
echo "Restart WordPress Studio and open the site to verify."
