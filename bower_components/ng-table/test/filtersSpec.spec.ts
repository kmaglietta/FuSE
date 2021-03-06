import { IFilterConfig, IFilterConfigProvider, default as browserModule } from '../src/browser';
import * as ng1 from 'angular';

describe('ngTableFilterConfig', () => {
    let ngTableFilterConfig: IFilterConfig,
        ngTableFilterConfigProvider: IFilterConfigProvider;

    beforeAll(() => expect(browserModule).toBeDefined());
    beforeEach(ng1.mock.module("ngTable-browser"));
    beforeEach(() => {
        ng1.mock.module((_ngTableFilterConfigProvider_: IFilterConfigProvider) => {
            ngTableFilterConfigProvider = _ngTableFilterConfigProvider_;
            ngTableFilterConfigProvider.resetConfigs();

        });
    });

    beforeEach(inject((_ngTableFilterConfig_: IFilterConfig) => {
        ngTableFilterConfig = _ngTableFilterConfig_;
    }));

    describe('setConfig', () => {

        it('should set aliasUrls supplied', () => {

            ngTableFilterConfigProvider.setConfig({
                aliasUrls: {
                    'text': 'custom/url/custom-text.html'
                }
            });
            expect(ngTableFilterConfig.config.aliasUrls['text']).toBe('custom/url/custom-text.html');
        });

        it('should merge aliasUrls with previous values', () => {
            ngTableFilterConfigProvider.setConfig({
                aliasUrls: {
                    'text': 'custom/url/text.html'
                }
            });

            ngTableFilterConfigProvider.setConfig({
                aliasUrls: {
                    'number': 'custom/url/custom-number.html'
                }
            });

            expect(ngTableFilterConfig.config.aliasUrls['text']).toBe('custom/url/text.html');
            expect(ngTableFilterConfig.config.aliasUrls['number']).toBe('custom/url/custom-number.html');
        });
    });

    describe('getTemplateUrl', () => {

        it('explicit url supplied', () => {
            let explicitUrl = 'path/to/my-template.html';
            expect(ngTableFilterConfig.getTemplateUrl(explicitUrl)).toBe(explicitUrl);
        });

        it('inbuilt alias supplied', () => {
            expect(ngTableFilterConfig.getTemplateUrl('text')).toBe('ng-table/filters/text.html');
        });

        it('custom alias supplied', () => {
            expect(ngTableFilterConfig.getTemplateUrl('my-template')).toBe('ng-table/filters/my-template.html');
        });

        it('alias registered with custom url', () => {
            ngTableFilterConfigProvider.setConfig({
                aliasUrls: {
                    'my-template': 'custom/url/my-template.html'
                }
            });
            expect(ngTableFilterConfig.getTemplateUrl('my-template')).toBe('custom/url/my-template.html');
        });

        it('inbuilt alias registered with custom url', () => {
            ngTableFilterConfigProvider.setConfig({
                aliasUrls: {
                    'text': 'custom/url/custom-text.html'
                }
            });
            expect(ngTableFilterConfig.getTemplateUrl('text')).toBe('custom/url/custom-text.html');
        });
    });
});