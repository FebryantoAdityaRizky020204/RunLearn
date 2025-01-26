import { expect, describe, it } from "vitest";
import { sayHello } from "../src/sayHello";

describe('say hello', () => {
    it('should return with name', () => {
        expect(sayHello('Aditya')).toBe('Halo Aditya!');
    });
})