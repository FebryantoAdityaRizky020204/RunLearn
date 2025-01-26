import { vi, expect, describe, it } from "vitest";

describe('mocking', () => {
    function sayHello(nama: string, callback: (message: string) => void){ 
        callback(`Halo ${nama}`);
    }

    it('should support mocking', () => {
        const callback = vi.fn();
        sayHello('Aditya', callback);
        expect(callback).toHaveBeenCalledWith('Halo Aditya');
    })
});