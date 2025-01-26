import { bench, expect, describe } from "vitest";

describe('test benchmarking', () => {
    function sayHello(nama: string): string {
        return `Halo ${nama}!`
    }

    bench('test benchmarking', () => { 
        const result = sayHello('Aditya');
        expect(result).toBe('Halo Aditya!');
    })
});