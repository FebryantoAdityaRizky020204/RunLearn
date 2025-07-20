import mongoose from "mongoose";
import config from "@/config";
import type { ConnectOptions } from "mongoose";
import { logger } from "@/lib/winston";

const clientOptions: ConnectOptions = {
    dbName: 'tangSan',
    appName: 'Blog API',
    serverApi: {
        version: "1",
        strict: true,
        deprecationErrors: true
    }
}


export const connectToDatabase = async() : Promise<void> => {
    if(!config.MONGO_URI) {
        throw new Error('MONGODB_URI is not defined in the environment variables');
    }

    try {
        await mongoose.connect(config.MONGO_URI, clientOptions);
        logger.info("Connected to MongoDB successfully ", {
            uri: config.MONGO_URI,
            options: clientOptions
        });
    } catch (error) {
        if(error instanceof mongoose.Error) {
            throw error;
        }
        logger.error('Error connecting to MongoDB:', error);
    }
}


export const disconnectFromDatabase = async(): Promise<void> => {
    try {
        await mongoose.disconnect();
        logger.info("Disconnected from MongoDB successfully");
    } catch (error) {
        logger.error('Error disconnecting from MongoDB:', error);
    }
}