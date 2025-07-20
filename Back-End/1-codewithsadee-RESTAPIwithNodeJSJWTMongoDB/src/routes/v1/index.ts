import { Router } from "express";

const router = Router();

// routes
import authRoutes from './auth';


// Root router
router.get('/', (req, res) => {
    res.status(200).json({
        message: 'Welcome to the Blog API',
        status: 'ok',
        version: '1.0.0',
        timestamp: new Date().toISOString()
    });
});

router.use('/auth', authRoutes);



export default router;