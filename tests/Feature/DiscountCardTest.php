<?php

namespace Tests\Feature;

use Tests\BaseTestWithAuthorization;

class DiscountCardTest extends BaseTestWithAuthorization
{
    /** @test */
    public function discount_card_form_url_is_working()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('frontend.discount-card.index'));

        $response->assertStatus(200);
    }
}
