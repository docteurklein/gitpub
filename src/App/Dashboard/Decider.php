<?php

namespace App\Dashboard;

use App\Dashboard;
use Github\Client;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("ALL")
 **/
class Decider
{
    private $dashboard;
    private $client;

    public function __construct(Dashboard $dashboard, Client $client)
    {
        $this->dashboard = $dashboard;
        $this->client = $client;
    }

    /**
     * @Serializer\VirtualProperty
     **/
    public function all()
    {
        foreach ($this->dashboard->getAllPRs() as $pr) {
            yield $pr;
        }
        foreach ($this->dashboard->getAllIssues() as $issue) {
            yield $issue;
        }
    }

    public function getLatest()
    {
        return $this->all()->current();
    }

    public function getLatestInvolvedIssue($user)
    {
        return $this->getInvolvedIssues($user)->current();
    }

    public function getLatestInvolvedPR($user)
    {
        return $this->getInvolvedPRs($user)->current();
    }

    private function getInvolvedElements($user, $type)
    {
        $q = vsprintf('q=type:%s+involves:%s+state:open&sort=update&order=desc', [
            $type,
            $user,
        ]);

        return json_decode($this->client->getHttpClient()->get('/search/issues?'.$q)->getBody(true), true);
    }

    public function getInvolvedIssues($user)
    {
        $issues = $this->getInvolvedElements($user, 'issue');
        foreach ($issues['items'] as $issue) {
            yield new Issue(new Element($issue), $issue['user']['repos_url']);
        }
    }

    public function getInvolvedPRs($user)
    {
        foreach ($this->getInvolvedElements($user, 'pr') as $pr) {
            yield new PR(new Element($pr));
        }
    }
}
