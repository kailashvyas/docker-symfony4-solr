<?php

namespace App\Tests\Service;

use App\Service\ApiService;
use App\Service\SearchService;
use Symfony\Component\HttpFoundation\Request;
use PHPUnit\Framework\TestCase;

/**
 * SearchServiceTest Test SearchService
 */
class SearchServiceTest extends TestCase 
{
    /**
     * Setup
     */
	public function setup()
	{
		$this->apiService = $this->getMockBuilder('App\Service\ApiService')->disableOriginalConstructor()->getMock();
		$this->searchService = new SearchService($this->apiService);
	}

    /**
     * TestCreateFilterParams
     */
	public function testCreateFilterParams()
	{
		$request = Request::create('http://127.0.0.1:83/?q=attr_genres:drama&page=2');
		$this->apiService->expects($this->any())
                    ->method("getApiResponse")
                    ->will($this->returnValue($this->apiResponse()));
        $response = $this->searchService->getSearchResults($request);
        $this->assertEquals($response, $this->apiResponse());
	}

    /**
     * TestGetSearchResults
     */
	public function testGetSearchResults()
	{
		$request = Request::create('http://127.0.0.1:83/?q=attr_genres%3Adrama');
        $this->apiService->expects($this->any())
            ->method("getApiResponse")
            ->will($this->returnValue($this->apiResponse()));
        $response = $this->searchService->getSearchResults($request);
        $this->assertEquals($response, $this->apiResponse());
	}

   /**
    * ApiResponse - mock api response returned by solr
    */ 
    public function apiResponse()
    {
        $response = '{
          "responseHeader":{
            "status":0,
            "QTime":1,
            "params":{
              "q":"*:*",
              "indent":"on",
              "wt":"json",
              "_":"1526845475100"}},
          "response":{"numFound":1,"start":0,"docs":[
              {
                "poster_path_t":["/mfMndRWFbzXbTx0g3rHUXFAxyOh.jpg"],
                "production_countries_name_ss":["United States of America"],
                "revenue_t":["0"],
                "overview_t":["foo"],
                "video_t":["false"],
                "id":"93837",
                "attr_genres":["Action",
                  "Comedy"],
                "title_t":["foo bar"],
                "tagline_t":["foo bar tagline"],
                "vote_count_i":55,
                "original_language_t":["en"],
                "status_t":["Released"],
                "spoken_languages_name_ss":["English"],
                "imdb_id_t":["tt1766094"],
                "adult_b":false,
                "backdrop_path_t":["/o4Tt60z94Hbgk8adeZG9WE4S2im.jpg"],
                "production_companies_name_ss":["foo foobar"],
                "release_date_dt":"2012-01-01T00:00:00Z",
                "popularity_f":0.3451248,
                "original_title_t":["foo bar"],
                "budget_i":0,
                "cast_name_ss":["foo bar",
                  "foo foo",
                  "foo foo bar"],
                "directors_name_ss":["blah blah"],
                "vote_average_f":5.9,
                "runtime_i":94,
                "_version_":1600925346322972672}]
            }}';

        return $response;
    }
}