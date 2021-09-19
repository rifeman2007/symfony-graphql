<?php

namespace App\Tests\Functional;

use App\Tests\WebTestCase;

class UserMutationTest extends WebTestCase
{
    public function testNewUser(): void
    {
        $query = <<<'EOF'
mutation NewUser($first_name: String = "Alwin", $last_name: String = "S") {
    NewUser(first_name: $first_name, last_name: $last_name) {
        first_name,
        last_name
    }
}
EOF;

        $expected = <<<EOF
{
    "data": {
        "NewUser": {
            "first_name": "Alwin",
            "last_name": "S"
        }
    }
}
EOF;

        $this->assertQuery($query, $expected);
    }

    public function testUpdateUser(): void
    {
        $query = <<<'EOF'
mutation UpdateUser($id: Int = 7, $first_name: String = "Aldwin", $last_name: String = "Sorila") {
    UpdateUser(id: $id, first_name: $first_name, last_name: $last_name) {
        id,
        first_name,
        last_name
    }
}
EOF;

        $expected = <<<EOF
{
    "data": {
        "UpdateUser": {
            "id": 7,
            "first_name": "Aldwin",
            "last_name": "Sorila"
        }
    }
}
EOF;

        $this->assertQuery($query, $expected);
    }

    public function testDeleteUser(): void
    {
        $query  = <<<'EOF'
mutation RemoveUser($id: Int = 7) {
    RemoveUser(id: $id) {
        first_name,
        last_name
    }
}
EOF;

        $result = $this->request($query);

        $this->assertCount(6, $result->RemoveUser);
    }
}
