<?php

namespace Drupal\pollinations_ai_fetch_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an 'Electricity Photos' Block.
 *
 * @Block(
 *   id = "electricity_photos_block",
 *   admin_label = @Translation("Electricity Photos Block"),
 *   category = @Translation("Custom"),
 * )
 */
class ElectricityPhotosBlock extends BlockBase {

  /**
   * Fetches electricity-related photos from Pollinations.AI.
   *
   * @return array
   *   Array of photo URLs.
   */
  private function fetchElectricityPhotos() {
    $photos = [];
    $prompts = [
      'electric lightning bolt in dark sky',
      'electrical power lines and towers'
    ];

    foreach ($prompts as $prompt) {
      $encoded_prompt = urlencode($prompt);
      $url = "https://image.pollinations.ai/prompt/{$encoded_prompt}?width=400&height=300&seed=" . rand(1, 1000);
      $photos[] = $url;
    }

    return $photos;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $photos = $this->fetchElectricityPhotos();

    $photo_markup = '';
    foreach ($photos as $index => $photo_url) {
      $photo_markup .= '<div style="margin: 20px 0;">';
      $photo_markup .= '<h3>Electricity Photo ' . ($index + 1) . '</h3>';
      $photo_markup .= '<img src="' . $photo_url . '" alt="Electricity related image" style="max-width: 400px; height: auto; border: 1px solid #ccc;" />';
      $photo_markup .= '</div>';
    }

    return [
      '#markup' => '<div class="electricity-photos-block">' . $photo_markup . '</div>',
    ];
  }

}