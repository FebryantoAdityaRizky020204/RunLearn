import winston from "winston";

import config from "@/config";

const {combine, timestamp, json, errors, align, printf, colorize} = winston.format;

const transports: winston.transport[] = [];

if(config.NODE_ENV === 'production') {
    transports.push(
        new winston.transports.Console({
            format: combine(
                colorize(),
                timestamp({format: 'YYYY-MM-DD HH:mm:ss A'}),
                align(),
                printf(({timestamp, level, message, ...meta}) => {
                    const metaStr = Object.keys(meta).length ? `\n${JSON.stringify(meta)}` : ''; 

                    return `${timestamp} [${level.toUpperCase()}]: ${message}${metaStr}`;
                })
            )
        })
    )
}


const logger = winston.createLogger({
    level: config.LOG_LEVEL || 'info',
    format: combine(timestamp(), errors({stack: true}), json()),
    transports, 
    silent: config.NODE_ENV === 'test' // Disable logging in test environment
})


export { logger };