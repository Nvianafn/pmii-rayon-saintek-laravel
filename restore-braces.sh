#!/usr/bin/env bash
set -e
lb=$(printf '\x7b\x7b')
rb=$(printf '\x7d\x7d')
uo=$(printf '\x7b\x21\x21')
uc=$(printf '\x21\x21\x7d')
root="/data/pmii/pmii_saintek/resources/views"
find "$root" -name '*.blade.php' -print0 | while IFS= read -r -d '' f; do
  sed -i "s|__LB__|$lb|g; s|__RB__|$rb|g; s|__UO__|$uo|g; s|__UC__|$uc|g" "$f"
done
echo "braces restored"
