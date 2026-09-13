import { defineConfig } from '@playwright/test';

export default defineConfig({
  testDir: './tests/browser',
  fullyParallel: true,
  reporter: 'list',
  use: {
    baseURL: process.env.RELATING_BASE_URL ?? 'http://127.0.0.1:8765',
    trace: 'retain-on-failure',
  },
});
