<?php
namespace WaterWisteria\AcceptLanguage;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use Carbon\CarbonInterval;

class AcceptLanguageMiddleware
{
	public const ACCEPT_LANGUAGE_TOKEN = 'Accept-Language';
	
	public function handle(Request $request, Closure $next)
	{
		$acceptLanguages = Config::get('acceptlanguages.Accept-Language', null);

		if(empty($acceptLanguages))
		{
			return $next($request);
		}
		
		// Check if there's a cookie just for us first...
		$cookieLocale = $request->cookie(self::ACCEPT_LANGUAGE_TOKEN);
		
		if(!empty($cookieLocale) && array_key_exists($cookieLocale, $acceptLanguages))
		{
			$this->setLocale($cookieLocale);
			
			return $next($request);
		}

		// If not check for an HTTP header
		$headerLocale = $this->processAcceptLanguageHeader($request->header(self::ACCEPT_LANGUAGE_TOKEN) ?? '');

		if(!empty($headerLocale) && array_key_exists($headerLocale, $acceptLanguages))
		{
			$this->setLocale($headerLocale);
		}
		
		return $next($request);
	}

	protected function processAcceptLanguageHeader(string $acceptLanguageHeader) : string
	{
		$headerLocale = \Locale::acceptFromHttp($acceptLanguageHeader);

		if(strlen($headerLocale) !== 2)
		{
			// We assume it's a regional language, such as en_GB or fr_CA.
			// Keep the language only because there's no easy fallback
			// from regional to just language.
			$headerLocale = substr($headerLocale, 0, 2);
		}

		return $headerLocale;
	}

	protected function setLocale($locale) : void
	{
		// Carbon uses momentjs format among others...
		// It only took me hours of paddling in random docs for this:
		// https://momentjs.com/docs/#/displaying/format/
		App::setLocale($locale);
		\Carbon\Carbon::setLocale($locale);
		CarbonInterval::setLocale($locale);
		\Date::setLocale($locale);
		$l = setlocale(LC_TIME, Config::get("acceptlanguages.locales.{$locale}", ''));

		// if $l is false then setLocale failed.
	}
}