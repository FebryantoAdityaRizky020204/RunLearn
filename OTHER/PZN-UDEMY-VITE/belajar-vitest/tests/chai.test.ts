import { assert, expect, describe, it } from "vitest";

function sayHello(nama: string): string {
    return `Halo ${nama}!`
}

describe('chai test', () => {
    it('should return with name', () => {
        expect(sayHello('Aditya')).to.be.a('string', 'Halo Aditya!');
    });

    it('should return with name:assert', () => {
        assert.equal(sayHello('Aditya'), 'Halo Aditya!');
    });
});