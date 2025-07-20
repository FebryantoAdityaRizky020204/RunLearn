/**
 * @copyright 2025 Aditya Rizky F - From YT Tutorial codewithsadee(2025)
 * @license Apache-2.0
 */

// *Node Modules
import express from 'express';
import cors from 'cors';
import cookieParser from 'cookie-parser';
import compression from 'compression';
import helmet from 'helmet';

/**
 * customs modules
*/
import config from '@/config';
import { CorsOptions } from 'cors';
import limiter from '@/lib/express_rate_limit';
import v1Routes from '@/routes/v1/index';
import { connectToDatabase, disconnectFromDatabase } from '@/lib/mongoose';
import { logger } from '@/lib/winston';
import { log } from 'console';

/**
 * *Express app initialization
 */
const app = express();

/** 
 * * configure cors option
 * */
const corsOptions: CorsOptions = {
    origin(origin, callback) {
        if (
            config.NODE_ENV === 'development' ||
            (typeof origin === 'string' && config.WHITELIST_ORIGINS.includes(origin)) ||
            !origin
        ) {
            callback(null, true);
        } else {
            callback(new Error(`CORS Error: ${origin} is not allowed`), false);
            logger.warn(`CORS Error: ${origin} is not allowed`);
        }
    }
}

/** 
 * @Apply cors middleware
 * */
app.use(cors( corsOptions ));

app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(cookieParser());
app.use(compression({
    threshold: 1024, // compress responses larger than 1KB
}));
app.use(helmet());
app.use(limiter);

(async () => {
    try {
        await connectToDatabase();
        app.use('/api/v1', v1Routes);
        app.listen(config.PORT, () => {
            logger.info(`Server is running on: http://localhost:${config.PORT}`);
        });
    } catch (error) {
        logger.error('Error during server initialization: ', error);
        if(config.NODE_ENV === 'production') {
            process.exit(1);
        }
    }
})();



const handleServerShutdown = async () => {
    try {
        await disconnectFromDatabase();
        logger.warn('Server is shutting down...');
        process.exit(0);
    } catch (error) {
        logger.error('Error during server shutdown: ', error);
        process.exit(1);
    }
}


process.on('SIGINT', handleServerShutdown);
process.on('SIGTERM', handleServerShutdown);