#!/bin/bash
# Asterisk сервер
server="root@IP"

# Уникальная метка
ts=$(date +%s%N)

# Создаем файл
callname=/tmp/zabbix-alert.$ts.call

# Call-файл Asterisk
echo "Channel: Local/$1@from-internal" > $callname
echo "MaxRetries: 2" >> $callname
echo "RetryTime: 60" >> $callname
echo "WaitTime: 30" >> $callname
echo "Application: Playback" >> $callname
echo "Data: invalid" >> $callname

sudo scp $callname $server:/var/spool/asterisk/outgoing/
rm -f $callname