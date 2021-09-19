<?php

namespace App\Tests\Functional;

use App\Tests\WebTestCase;

class UserQueryTest extends WebTestCase
{
    public function testGetUser(): void
    {
        $query = <<<'EOF'
query getUser($id: Int = 1) {
    getUser(id: $id) {
        id,
        first_name,
        last_name
    }
}
EOF;

        $expected = <<<EOF
{
    "data": {
        "getUser": {
            "id": 1,
            "first_name": "Admin",
            "last_name": "Admin"
        }
    }
}
EOF;

        $this->assertQuery($query, $expected);
    }

    public function testGetUsers(): void
    {
        $query = <<<'EOF'
query getUsers($limit: Int = 20) {
    getUsers(limit: $limit) {
        id,
        first_name,
        last_name
    }
}
EOF;

        $result = $this->request($query);

        $this->assertCount(6, $result->getUsers);
    }
}
