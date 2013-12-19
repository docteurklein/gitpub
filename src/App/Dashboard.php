<?php

namespace App;

use Github\Client;

class Dashboard
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAllIssues()
    {
        foreach ($this->getAllRepos() as $repo) {
            foreach ($this->client->api('issue')->org('KnpLabs', ['state' => 'open']) as $issue) {
                yield new Dashboard\Issue(new Dashboard\Element($issue), $repo['html_url']);
            }
        }
    }

    public function getAllPRs()
    {
        foreach ($this->getAllRepos() as $repo) {
            $prs = $this->client->api('pull_request')->all('KnpLabs', $repo['name'], ['state' => 'open']);
            foreach ($prs as $pr) {
                yield new Dashboard\PR(new Dashboard\Element($pr));
            }
        }
    }

    private function getAllRepos()
    {
        return $this->client->api('organization')->repositories('KnpLabs');
    }
}
