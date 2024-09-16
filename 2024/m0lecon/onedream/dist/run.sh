#!/bin/sh

EXPLOIT=$1
if [ ! -f "$EXPLOIT" ]; then
    touch $EXPLOIT
fi

RAND=$(head -n 100 /dev/urandom | sha256sum | awk '{printf $1}')
cp ./flag.img /tmp/$RAND

qemu-system-aarch64 \
    -kernel ./Image \
    -M virt -cpu cortex-a57 \
    -smp 1 \
    -m 2G \
    -hda /tmp/$RAND \
    -hdb $EXPLOIT \
    -initrd ./initramfs.cpio.gz \
    -append "console=ttyAMA0 quiet loglevel=3 oops=panic panic_on_warn=1 panic=-1 kpti=on page_alloc.shuffle=1" \
    -drive if=pflash,format=raw,file=./efi.img,readonly=on \
    -object rng-random,filename=/dev/urandom,id=rng0 \
    -device virtio-rng-pci,rng=rng0 \
    -monitor /dev/null \
    -nographic \
    -no-reboot

rm -f $EXPLOIT /tmp/$RAND
