/**
 * @copyright 2025 Aditya Rizky F - From YT Tutorial codewithsadee(2025)
 * @license Apache-2.0
 */

import dotenv from 'dotenv';

dotenv.config();


const config = {
    PORT: process.env.PORT || 3000,
    NODE_ENV: process.env.NODE_ENV || 'development',
    WHITELIST_ORIGINS: ['http://localhost:3000', 'http://example.com', 'https://docs.blog-api.codewithsadee.com'],
    MONGO_URI: process.env.MONGO_URI || 'mongodb://localhost:27017/tangSan',
    LOG_LEVEL: process.env.LOG_LEVEL || 'info',
}

export default config;